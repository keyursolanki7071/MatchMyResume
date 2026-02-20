import { useForm } from '@inertiajs/react'
import { FormEvent } from 'react'
import {route} from 'ziggy-js'

interface FormData {
    resume: File | null
}

export default function Dashboard() {
    const { data, setData, post, processing, errors } = useForm<FormData>({
        resume: null,
    })

    console.log(route('resumes.store'));
    const submit = (e: FormEvent<HTMLFormElement>) => {
        e.preventDefault()
        post(route('resumes.store'), {
            forceFormData: true,
        })
    }

    return (
        <div className="p-6">
            <h1 className="text-xl font-bold mb-4">Upload File</h1>

            <form onSubmit={submit}>
                <input
                    type="file"
                    onChange={(e) => {
                        if (e.target.files) {
                            setData('resume', e.target.files[0])
                        }
                    }}
                />

                {errors.resume && (
                    <div className="text-red-500 mt-2">
                        {errors.resume}
                    </div>
                )}

                <button
                    type="submit"
                    disabled={processing}
                    className="mt-4 px-4 py-2 bg-black text-white"
                >
                    {processing ? 'Uploading...' : 'Upload'}
                </button>
            </form>
        </div>
    )
}